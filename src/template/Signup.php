<div class="page page-center">
  <div class="container-tight py-4">
    <div class="text-center mb-4">
      <a href="/">
        <img src="https://assets.mofhy.tk/img/logo.svg" height="50" alt="Mofhy Lite">
      </a>
    </div>
    <form class="card card-md" action="function/Signup" method="post" onsubmit="
					var password = document.getElementById('password').value;
					var cpassword = document.getElementById('cpassword').value;
					if(password != cpassword){
						alert('Passwords Not Match!');
						return false;
					}
					return true;
				">
      <div class="card-body">
        <h2 class="card-title text-center mb-4">Create New Account</h2>
        <div id="hidden-area">
          <?php
          if (isset($_SESSION['message'])) {
            echo ($_SESSION['message']);
            unset($_SESSION['message']);
          }
          ?>
        </div>
        <div class="mb-3">
          <label class="form-label required">First Name</label>
          <input type="text" name="first" class="form-control" placeholder="First Name" autofocus required>
        </div>
        <div class="mb-3">
          <label class="form-label required">Last Name</label>
          <input type="text" name="last" class="form-control" placeholder="Last Name" required>
        </div>
        <div class="mb-3">
          <label class="form-label required">Email Address</label>
          <input type="email" name="email" class="form-control" placeholder="Enter email" required>
        </div>
        <div class="mb-3">
          <label class="form-label required">Password</label>
          <div class="input-group input-group-flat">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
          </div>
        </div>
        <div>
          <label class="form-label required">Confirm Password</label>
          <div class="input-group input-group-flat">
            <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Password" required>
          </div>
        </div>
        <div class="form-footer">
          <button type="submit" class="btn btn-primary w-100" name="signup">Create New Account</button>
        </div>
        <div class="text-center text-muted mt-3">
          Already a member? <a href="login" tabindex="-1">Login</a>
        </div>
      </div>
    </form>
  </div>
</div>
