<?php
include "./include/header.php";

if(!empty($_POST)){
    pre($_POST);
}

function AddCandidatesUI($post){
    $key = getKey($post);
    $html = "<h2 class='my-5 text-center text-decoration-underline'>$post</h2>";
    $html .= "
        <form class='needs-validation form_{$key} was-validated' novalidate style='position: relative;'>
            
            <div id='candidatesContainer_{$key}'>
                <!-- Candidate 1 -->
                <div class='row candidate_{$key}'>
                    <div class='closeBtn d-none' onclick='$(this).parent().remove()'>X</div>
                    <div class='col-6'>                    
                        <label for='candidateName' class='form-label'>Candidate Name:</label>
                        <input type='text' name='{$key}__candidateName[]' required class='form-control'>
                        <div class='invalid-feedback'>You must enter a valid name</div>
                    </div>
                    <div class='col-6'>
                        <label for='candidatePhoto'  class='form-label'>Candidate Photo:</label>
                        <input type='file' name='{$key}__candidatePhoto[]' accept='image/*' required class='form-control' onchange='handleFileSelect(this)'>
                        
                        <div class='invalid-feedback'>You must select a valid image file</div>
                    </div>
                    <hr>
                </div>
            </div>
        </form>                
        <button type='button' class='btn btn-success btn-lg ms-3' onclick='addMoreCandidate(`$key`)'>Add More <b>$post</b> Candidate</button>
    ";
    return $html;
}
?>

<main class="container-fluid mt-3">
<!--    <form id="regForm" action="" method="post" >-->
        <?php
        $posts = getPosts();
        foreach ($posts as $i => $post) {
            echo "<div class='tab row mx-5 step-$i'>";
            echo AddCandidatesUI("$post");
            echo "</div>";
        }
        ?>


        <div class="position-fixed bottom-0 end-0 p-3">
            <div class="row  px-5">
                <div class="col-12 d-flex justify-content-end ">
                    <button class="btn btn-primary btn-lg ms-3" type="button" id="prevBtn"
                            onclick="nextPrev(-1)">
                        Previous
                    </button>
                    <button class="btn btn-primary btn-lg ms-3" type="button" id="nextBtn"
                            onclick="nextPrev(1)">
                        Next
                    </button>
                </div>
            </div>
        </div>
<!--    </form>-->
</main>
<script>
    $("div.tab").hide();
    let currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        let tabs = $("div.tab");
        tabs.eq(n).show();
        if (n === 0) {
            $("#prevBtn").hide();
        } else {
            $("#prevBtn").show();
        }
        if (n === (tabs.length - 1)) {
            $("#nextBtn").html("Submit");
        } else {
            $("#nextBtn").html("Next");
        }
        //fixStepIndicator(n)
    }

    function nextPrev(n) {
        let form = document.querySelector(`.tab.step-${currentTab} form`)
        if (!form?.checkValidity() && n >0) {
           return ;
        }

        let tabs = $("div.tab");
        tabs.eq(currentTab).hide();
        currentTab = currentTab + n;

        if (currentTab >= tabs.length) {
            // send data to PHP

            $.ajax({
                type: "POST",
                url: "./createCandidateJson.php",
                data: formData2Json(),
                success: function(data){
                    console.log("data saved",data)
                    alert("Candidate data saved successfully.")
                },
                // dataType: dataType
            });
            return false;
        }
        showTab(currentTab);
    }

    function formData2Json(){
        let data = {};
        let ip = $("input");
        for(let i=0;i<ip.length;i=i+2){
            let name = ip[i];
            let img = ip[i+1];
            let key = name.name.split('__')[0];
            data[key] = data[key] || [];
            data[key].push([name.value,img.data])
        }
        return data;
    }

    ///////////////////////////
    function addMoreCandidate(key){
        let form = document.querySelector('.form_'+key)
        if (!form.checkValidity()) {
            return ;
        }
        // Clone the candidate template
        let candidateTemplate = document.querySelector('.candidate_'+key);
        let newCandidate = candidateTemplate.cloneNode(true);

        // Reset input values in the new candidate
        newCandidate.querySelectorAll("input").forEach(e=>e.value='')
        newCandidate.querySelector(".closeBtn").classList.remove("d-none");
        // Append the new candidate to the container
        document.getElementById('candidatesContainer_'+key).appendChild(newCandidate);
    }


    function handleFileSelect(fileInput) {
        let file = fileInput.files[0]; // FileList object
        let fileReader = new FileReader();
        fileReader.readAsDataURL(file);
        fileReader.addEventListener("load", function () {
            // console.log("Base64",fileReader.result)
            resizeImage((fileReader.result)).then(e=>fileInput.data = e).catch(e=>console.error("Error in resizing image",e));
        });
    }
    function resizeImage(dataString){
        const res = {
            width:400,
            height:400,
            max:50000	//50KB
        };
        return new Promise((resolve, reject) => {
            const img = new Image();
            img.addEventListener('load', () => {
                // resolve("ok")
                let canvas = document.createElement('canvas');
                let ctx = canvas.getContext('2d');

                canvas.width = res.width;		// We set the dimensions at the wanted size.
                canvas.height = res.height;

                ctx.drawImage(img, 0, 0, res.width, res.height);		// We resize the image with the canvas method drawImage();
                let q = 1;		//image quality
                do{
                    var dataURI = canvas.toDataURL("image/jpeg",q);
                    q = q - .01;
                }while(dataURI.length > res.max)		//max image size, if larger size then reduce the quality
                console.log('new image size @ '+q,dataURI.length)
                console.log('Image resized')

                resolve(dataURI)
            });
            img.addEventListener('image error', (err) => reject(err));
            img.src = dataString;
        });
    }
</script>