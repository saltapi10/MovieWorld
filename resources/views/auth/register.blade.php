<form method="POST" action="/register" class="text-dark">
    @csrf
    <div class="mb-3">
        <label for="register_name" class="form-label">Full name</label>
        <input required type="text" name="name" class="form-control" id="register_name">
    </div>
    <div class="mb-3">
        <label for="register_email" class="form-label">Email address</label>
        <input required type="email" name="email" class="form-control" id="register_email">
    </div>
    <div class="mb-3">
        <label for="register_password" class="form-label">Password</label>
        <input required type="password" name="password" class="form-control" id="register_password">
    </div>
    <button type="submit" class="btn btn-primary mb-3">Submit</button>
</form>
