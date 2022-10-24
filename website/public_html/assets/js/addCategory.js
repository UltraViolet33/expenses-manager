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

  fetch("addCategory.php", {
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
      displayOptionsCategories(res);
    })

    .catch(err => console.log(err));
}

const displayMessage = data => {
  const messageDiv = document.getElementById("message");
  const pElement = document.createElement("p");
  pElement.textContent = "";

  pElement.textContent = data.message;
  messageDiv.appendChild(pElement);
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

const checkboxeRecurrence = document.getElementById("inputRecurrence");

checkboxeRecurrence.addEventListener("change", function () {

  let period_div = document.getElementById("period");
  let date_div = document.getElementById("date");

  if (this.checked) {
    console.log("ok");
   date_div.style.display = "none";
   period_div.style.display = "block";

  } else {
    date_div.style.display = "block";
    period_div.style.display = "none";
  }
});

function createInputDate() {
  let period_div = document.getElementById("period");

  Array.from(period_div.children).forEach(function (item) {
    period_div.remove(item);
    console.log(item);
  });

  let date_div = document.getElementById("date");
  let inputDate = document.createElement("input");
  let labelDate = document.createElement("label");

  labelDate.textContent = "date";

  inputDate.setAttribute("type", "date");

  date_div.appendChild(labelDate);
  date_div.appendChild(inputDate);
}

function createSelectPeriod() {
  let date_div = document.getElementById("date");

  Array.from(date_div.children).forEach(function (item) {
    date_div.remove(item);
    console.log(item);
  });

  let period_div = document.getElementById("period");

  console.log(period_div);
  let selectElement = document.createElement("select");
  selectElement.classList.add("form-select");
  selectElement.setAttribute("name", "period");
  const optionsArray = [
    { value: "Week", text: "Each week" },
    { value: "Month", text: "Each Month" },
  ];

  optionsArray.forEach(element => {
    let optionElement = document.createElement("option");
    optionElement.setAttribute("value", element.value);
    optionElement.textContent = element.text;
    selectElement.appendChild(optionElement);
  });

  period_div.appendChild(selectElement);
}
