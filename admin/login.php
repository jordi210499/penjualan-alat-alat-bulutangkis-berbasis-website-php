<style>
  body {
    background-image: url("../images/login.png");
    background-attachment: fixed;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
  }
</style>
<div class="py-4 my-4">
  <div class="d-flex justify-content-center py-5 my-5">
    <div class="card" style="width: 18rem; background-color:aliceblue;">
      <div class="card-body">
        <h5 class="card-title text-center">Login Admin</h5>
        <form name="logForm" method="post" action="?open=Login-Validasi">
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" name="txtUsername" type="text" size="30" maxlength="20">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="txtPassword" type="password" size="30" maxlength="20">
          </div>
          <br>
          <button class="btn btn-outline-primary btn-block" input type="submit" name="btnLogin" value=" Login ">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>