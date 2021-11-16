<?php
    ob_start();
    session_start();
    $PageName = "login";
    require "global/header.php";
    if (COUNT($_SESSION) == 0)
    {
        ?>
        <section class="form">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <form class="login" action="" method="POST">
                                <h4 class="text-center"><?php echo lang('LogIn'); ?></h4>
                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control" name="UserName" id="floatingInput" placeholder="UserName" autocomplete="off" required>
                                    <label for="floatingInput"><?php echo lang('UserName'); ?></label>
                                </div>
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="Password" id="floatingPassword" placeholder="Password" required>
                                    <label for="floatingPassword"><?php echo lang('Password'); ?></label>
                                </div>
                                <div class="vstack gap-2 col-md mx-auto">
                                    <button class="btn btn-primary btn-lg d-grid gap-2" type="submit" name="login"><?php echo lang('LogIn'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                    // Check If User Coming From HTTP Post Request
                    if (isset($_POST['login']))
                    {
                        $stmt = $con->prepare('SELECT * FROM employees WHERE UserName = ? AND Pass = ?');
                        $stmt->execute(array($_POST['UserName'], SHA1($_POST['Password'])));
                        // If Count > 0 This Mean The Database Contain Record About This User
                        if ($stmt->rowCount() > 0)
                        {
                            $user = $stmt->fetch();
                            if ($user['Job'] == 'Admin')
                            {
                                $_SESSION['admin'] = $user['EmpId'];
                                header("Location: cpanel/admin/index.php");
                            }
                            else 
                            {
                                $_SESSION['reception'] = $user['EmpId'];
                                header("Location: panel.php");
                            }
                        }
                        else 
                        {
                            $stmt = $con->prepare('SELECT * FROM clients WHERE UserName = ? AND Pass = ?');
                            $stmt->execute(array($_POST['UserName'], SHA1($_POST['Password'])));
                            if ($stmt->rowCount() > 0)
                            {
                                $user = $stmt->fetch();
                                $_SESSION['client'] = $user['ClientId'];
                                header('Location: panel.php');
                            }
                            else 
                            {
                                ?>
                                <div class="alert alert-danger d-flex align-items-center alert-dismissible show" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                    <div>
                                        <?php echo lang('Sorry You Don\'t Have An Account'); ?>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php
                            }
                        }
                    }?>
                </div>
            </div>
        </section>
        <?php
    }
    else
    {
        header("Location: index.php");
    }
    require 'global/footer.php';
    ob_end_flush();
?>