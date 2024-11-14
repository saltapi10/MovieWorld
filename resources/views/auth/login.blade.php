<form method="POST" action="/login" class="text-dark">
    @csrf
    <div class="mb-3">
        <label for="login_email" class="form-label">Email address</label>
        <input required type="email" name="email" class="form-control" id="login_email">
    </div>
    <div class="mb-3">
        <label for="login_password" class="form-label">Password</label>
        <input required type="password" name="password" class="form-control" id="login_password">
    </div>
    <button type="submit" class="btn btn-primary mb-3">Submit</button>
</form>
