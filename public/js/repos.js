addEventListener('DOMContentLoaded', (event) => {
  let searchReposBtnElm = document.getElementById("search-repos-btn");

  searchReposBtnElm.onclick = submitReposForm;

  window.baseUrl = 'http://localhost:8080/';

  function submitReposForm(e){
    e.preventDefault();
    loadReposRequest(); 
  }

  function loadReposRequest() {
    var inputPerPage = $('#per_page').val();
    var inputStartDate = $('#start_date').val();
    console.log(inputStartDate,inputPerPage);
    fetch(`${window.baseUrl}api/get-repos?`+ new URLSearchParams({
      per_page: inputPerPage,
      start_date: inputStartDate,
  }))
      .then((blob) => blob.json())
      .then((data) => {
        renderReposRequests(data);
      });
  }

  function renderReposRequests(repos) {
    let repoListHtml = '';
    console.log(repos['repos']);
    repos['repos'].forEach((repo,i) => {
      repoListHtml += `
        <tr>
          <th scope="row">${i+1}</th>
          <td>${repo['full_name']}</td>
          <td><img src="${repo['avatar_url']}" style="max-height:100px;max-width:100px" > </td>
          <td><a href="${repo['html_url']}" target="_blank"  class="btn btn-sm btn-success">repo url</a></td>
          <td>${repo['created_at']}</td>
        </tr>
        `;
    });
    document.querySelector('#repos-table').innerHTML = repoListHtml;
  }
  loadReposRequest();
});