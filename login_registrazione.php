<?php 
include_once 'inc/functions.php';
get_header("Login");

?>

<main id="login" class="text-dark">
    <?php if($_SESSION['mex'] != '' ) :?>
        <div class="alert alert-succes mx-auto viewport-20" role="alert"><?php echo $_SESSION['mex']; ?></div>
    <?php $_SESSION['mex'] = ''; endif; ?>
    <?php if($_SESSION['error'] != '' ) :?>
        <div class="alert alert-danger mx-auto viewport-20" role="alert"><?php echo $_SESSION['error']; ?></div>
    <?php $_SESSION['error'] = ''; endif; ?>
    <section class="min-height d-flex justify-content-between align-items-center container w-50">
        <form action="registrazione.php" method="POST">
            <h1 class="fs-1">Register</h1>
            <div class="mb-3">
                <label for="email-register" class="form-label">Email address</label>
                <input type="email" name="email-register" class="form-control" id="email-register" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password-register" class="form-label">Password</label>
                <input type="password" name="password-register" class="form-control" id="password-register">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <form action="login.php" method="POST">
            <h1 class="fs-1">Login</h1>
            <div class="mb-3">
                <label for="username-login" class="form-label">Email address</label>
                <input type="email" class="form-control" name="username-login" id="username-login" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password-login" class="form-label">Password</label>
                <input type="password" name="password-login" class="form-control" id="password-login">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section>
</main>

<?php 
get_footer();
?>