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