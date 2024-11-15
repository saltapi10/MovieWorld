<form method="POST" action="/movie-create" class="text-dark">
    @csrf
    <div class="mb-3">
        <label for="movie_title" class="form-label">Movie Title</label>
        <input required type="text" name="title" class="form-control" id="movie_title">
    </div>
    <div class="mb-3">
        <label for="movie_description" class="form-label">Movie Description</label>
        <textarea id="movie_description" class="form-control" name="description" rows="4" cols="50"></textarea>
    </div>
    <button type="submit" class="btn btn-primary mb-3">Submit</button>
</form>
