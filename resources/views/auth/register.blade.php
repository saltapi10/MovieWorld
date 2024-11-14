<form method="POST" action="/register" class="text-dark">
    @csrf
    <div class="mb-3">
        <label for="exampleInputName" class="form-label">Full name</label>
        <input required type="text" name="name" class="form-control" id="exampleInputName">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input required type="email" name="email" class="form-control" id="exampleInputEmail1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input required type="password" name="password" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn btn-primary mb-3">Submit</button>
</form>
