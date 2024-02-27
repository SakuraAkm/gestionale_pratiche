<?php 
include_once 'inc/functions.php';
get_header("Login");
?>

<main id="login" class="text-dark">

    <?php if(isset($_SESSION['error']) ) :?>
        <div class="my-alert text-center opacity alert alert-danger mx-auto viewport-20 position-fixed" role="alert"><?php echo $_SESSION['error']; ?></div>
    <?php unset($_SESSION['error']); endif; ?>

    <section class="min-height d-flex justify-content-center align-items-center container w-50">

        <form action="login.php" method="POST">
            <h1 class="display-4 fw-semibold text-center pb-4">LOGIN</h1>
            <div class="mb-3">
                <label for="nome-login" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome-login" id="nome-login" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="username-login" class="form-label">Email address</label>
                <input type="email" class="form-control" name="username-login" id="username-login" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="password-login" class="form-label">Password</label>
                <input type="password" name="password-login" class="form-control" id="password-login" required>
            </div>
            <div class="d-flex justify-content-center mb-4">
                <button type="submit" class="btn btn-primary fs-5 mt-3">Submit</button>
            </div>
        </form>
    </section>
</main>

<?php 
get_footer();
?>