addEventListener('DOMContentLoaded', (event) => {

  window.baseUrl = 'http://localhost:8080/';
  let searchReposBtnElm = document.querySelector("#search-repos-btn");
  let reposTable = document.querySelector('#repos-table');
  let body = document.querySelector("body");
  let inputPerPage = document.querySelector("#per_page").value;
  let inputStartDate = document.querySelector('#start_date').value;
  let loadMoreReposBtnElm = document.querySelector('#loadMoreRepos');
  let pageNumber = 1;
  let counter = 0;

  searchReposBtnElm.onclick = submitReposForm;
  loadMoreReposBtnElm.onclick = loadReposRequest;

  function submitReposForm(e) {
    e.preventDefault();
    pageNumber = 1;
    inputPerPage = document.querySelector("#per_page").value;
    inputStartDate = document.querySelector('#start_date').value;
    reposTable.innerHTML = '';
    loadReposRequest();
  }

  function loadReposRequest() {
    console.log(inputStartDate, inputPerPage);
    fetch(`${window.baseUrl}api/get-repos?` + new URLSearchParams({
      start_date: inputStartDate,
      per_page: inputPerPage??10,
      page: pageNumber??1,
    }))
      .then((blob) => blob.json())
      .then((data) => {
        renderReposRequests(data);
        pageNumber += 1;
      });
  }

  function renderReposRequests(repos) {
    let repoListHtml = '';
    repos['repos'].forEach((repo, i) => {
      repoListHtml += `
        <tr>
          <th scope="row">${counter+=1}</th>
          <td>${repo['full_name']}</td>
          <td><img src="${repo['avatar_url']}" style="max-height:100px;max-width:100px" > </td>
          <td><a href="${repo['html_url']}" target="_blank"  class="btn btn-sm btn-success">repo url</a></td>
          <td>${repo['created_at']}</td>
        </tr>
        `;
    });
    reposTable.innerHTML += repoListHtml;
  }
  loadReposRequest();
});