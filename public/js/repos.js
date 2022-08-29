addEventListener('DOMContentLoaded', (event) => {
  window.baseUrl = 'http://localhost:8080/';
  function loadReposRequest() {
    fetch(`${window.baseUrl}api/get-repos`)
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
          <td><a href="${repo['url']}" class="btn btn-sm btn-success">repo url</a></td>
          <td>${repo['created_at']}</td>
        </tr>
        `;
    });
    document.querySelector('#repos-table').innerHTML = repoListHtml;
  }
  loadReposRequest();
});