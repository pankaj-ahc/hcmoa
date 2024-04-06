<?php
include "./include/header.php";

if(!empty($_POST['admin1']) && !empty($_POST['admin2']) ){
    newSession($_POST['admin1'],$_POST['admin2']);
    echo '
        <div class="text-center container d-flex flex-wrap justify-content-center align-items-center" style="font-size: xx-large;color: green;text-transform: uppercase;height: calc(100vh - 60px);">
            <b>New voting session started successfully!</b>
            <br/>
            <small>Data will be stored at "'.getSession().'"</small>
        </div>';
}else{
?>

    <main class="container-fluid mt-3">
        <!--    <form id="regForm" action="" method="post" >-->
        <div class="tab row mx-5 step-0" style=""><h2 class="my-5 text-center text-decoration-underline">Admin
                Panel</h2>
            <form method="post" class="needs-validation form_admin_panel was-validated" novalidate="" onsubmit="createSession();" style="position: relative;">

                <!-- Candidate 1 -->
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="admin1" class="form-label">First Admin Password:</label>
                        <input type="password" name="admin1" required="" class="form-control admin1" minlength="6">
                        <div class="invalid-feedback">You must enter a password</div>
                    </div>
                    <div class="col-6">
                        <label for="admin1cnf" class="form-label">Confirm First Admin Password:</label>
                        <input type="password" name="admin1cnf" required="" class="form-control admin1 cnf" minlength="6">
                        <div class="invalid-feedback">Password must be same as First Admin Password</div>
                    </div>
                </div>
                <hr/>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="admin2" class="form-label">Second Admin Password:</label>
                        <input type="password" name="admin2" required="" class="form-control admin2" minlength="6">
                        <div class="invalid-feedback">You must enter a password</div>
                    </div>
                    <div class="col-6">
                        <label for="admin2cnf" class="form-label">Confirm Second Admin Password:</label>
                        <input type="password" name="admin2cnf" required="" class="form-control admin2 cnf" minlength="6">
                        <div class="invalid-feedback">Password must be same as Second Admin Password</div>
                    </div>
                </div>
                <hr/>
                <div class="row px-4">
                    <input type="submit" class="btn btn-success btn-lg px-3 col-12" name="newSession" value="Create New Voting Session"/>
                </div>
            </form>

        </div>

        <!--    </form>-->
    </main>
    <script>
        $(function () {
            // Add keypress event listener to all input fields
            $('input.cnf').keyup(function (event) {
                const pass1 = $(this).parent().prev().find('input').val();
                const pass2 = $(this).val();
                // console.log('Keypress detected on input field:', pass1, pass2,this);
                if (pass2 !== pass1) {
                    this.setCustomValidity('err');
                } else {
                    this.setCustomValidity('')
                }
            });
        });
        function createSession(){
            let form = document.querySelector('form')
            if (!form.checkValidity()) {
                return ;
            }
        }
    </script>
<?php
}