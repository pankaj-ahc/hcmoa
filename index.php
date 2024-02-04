<?php
include "./include/header.php";

?>
<main class="container-fluid mt-3">
    <form id="regForm" action="saveVote.php" method="post">
        <?php
        $candidates = getCandidates();
        $posts = getPosts();
        foreach ($posts as $i => $post) {
            echo "<div class='tab row mx-3 step-$i'>";
            echo PostUI("$post", $candidates->{$post});
            echo "</div>";
        }
        ?>
        <div class="tab row mx-5 step-3">
            <h2 class="my-5 text-center text-decoration-underline">Voting Summary</h2>
            <table class="table table-bordered border-primary table-hover">
                <thead>
                <tr>
                    <th scope="col" width="5%">#</th>
                    <th scope="col" width="30%">Post</th>
                    <th scope="col">Voted For</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($posts as $i => $post) {
                    $key = getKey($post);
                    $j = $i + 1;
                    echo "<tr>
                    <td>$j.</td>
                    <td>$post</td>
                    <td id='{$key}_voted'></td>
                </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="position-fixed bottom-0 end-0 p-3">
            <div class="row  px-5 navBtn">
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
    </form>
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
        let tabs = $("div.tab");
        tabs.eq(currentTab).hide();
        currentTab = currentTab + n;
        if (currentTab === tabs.length - 1) {
            <?php
            foreach ($posts as $i => $post) {
                $key = getKey($post);
                echo "
                $('#{$key}_voted').text(
                    $('#regForm input[name={$key}]:checked~label').text()
                );
                ";
            }
            ?>
            $('#executive_members_voted').text(
                $('#regForm input[name="executive_members[]"]:checked~label').map((i, e) => e.innerText).toArray().join(', ')
            );
        }
        if (currentTab >= tabs.length) {
            $("#regForm").submit();
            return false;
        }
        showTab(currentTab);
    }

    let nextTimer = null;
    // Auto move to next screen
    $("input[type=radio]").on("change", function () {
        clearTimeout(nextTimer);
        nextTimer = setTimeout(function () {
            // nextPrev(1)
        }, 1000)
    })


    function calculateSize(){
        let rect1 =document.getElementsByClassName('candidate_container')[0].getBoundingClientRect();
        let rectEnd =document.getElementsByClassName('navBtn')[0].getBoundingClientRect();
        return {
            top:rect1.top,
            right:rect1.right,
            bottom:rectEnd.top,
            left:rect1.left,
            width:rect1.width,
            height:rectEnd.top - rect1.top
        }
    }
</script>
<?php
include "./include/footer.php";
?>
