<div class="container text-center">
  <h1>get Repositories</h1>
  <form method="get" id="form-repos">

    <div class="row">
      <div class="col">
        <div class="input-group mb-3">
          <label for="start">per page:</label></br>
          <select  name="per_page" id="per_page" class="form-control">
            <!-- <option value="" selected>Open this select menu</option> -->
            <option value="10">10</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="input-group mb-3">
          <label for="start">Start date:</label>
          <input type="date" name="start_date" value="2022-01-02"   id="start_date"  >
        </div>
      </div>
      <div class="col">
        <div class="input-group mb-3">
          <button type="submit" class="form-control"  id="search-repos-btn">Search Repos</button>
        </div>
      </div>
    </div>

  </form>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Full Name</th>
        <th scope="col">Avatar</th>
        <th scope="col">Repo Url</th>
        <th scope="col">Created At</th>
      </tr>
    </thead>
    <tbody id="repos-table">
    </tbody>
  </table>
  <div class="row">
    <div class="col-md-12">
      <button class="btn btn-success" id = "loadMoreRepos" >Load More</button>
    </div>
  </div>
</div>