const btnSubmitCat = document.getElementById("btn-submit-cat");

btnSubmitCat.addEventListener("click", getCategory);

function getCategory(event) {
  event.preventDefault();
  const inputCatName = document.getElementById("category_name");
  const categoryName = inputCatName.value;
  inputCatName.value = "";
  if (categoryName != "") {
    addCategory(categoryName);
  }
}

function addCategory(categoryName) {
  const category = { name: categoryName };

  fetch("../categories/addCategoryAjax.php", {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    method: "POST",
    body: JSON.stringify(category),
  })
    .then(res => res.json())
    .then(res => {
      displayMessage(res);
      if (res.allCategories) {
        displayOptionsCategories(res);
      }
    })

    .catch(err => console.log(err));
}

const displayMessage = data => {
  const messageP = document.getElementById("message");
  messageP.textContent = "";
  messageP.textContent = data.message;
};

function displayOptionsCategories(data) {
  const selectCategories = document.getElementById("categories-select");
  const categories = data.allCategories;

  Array.from(selectCategories.children).forEach(function (item) {
    selectCategories.remove(item);
  });

  categories.forEach(category => {
    let optionElement = document.createElement("option");
    optionElement.setAttribute("value", category.id_category);
    optionElement.textContent = category.name;
    selectCategories.appendChild(optionElement);
  });
}
