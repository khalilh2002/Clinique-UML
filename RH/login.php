<?php
    $page_title = "RH Home"; // header title from base.php
    require_once "base.php";
?>
<section>
<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3 login-container">
      <h3 class="mb-4">Login</h3>
      <form>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </div>
</div>
</section>

<?php
    require_once "footer.php";
?>