/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
  displayProjects();
  $("#loadMore").click(handleProjLoadMore);
});

function displayProjects()
{
  max_size = $("#proj-list li").size();
  display_count = 3;
  load_count = 3;

  $("#proj-list li:lt(" + display_count + ")").show();

  if (max_size > display_count)
    $("#loadMore").show();
  else
    $("#loadMore").hide();
}

function handleProjLoadMore()
{
    if (display_count + load_count <= max_size)
      display_count += load_count;
    else
      display_count = max_size;

    $("#proj-list li:lt(" + display_count + ")").show();

    if (display_count == max_size)
      $("#loadMore").hide();
}