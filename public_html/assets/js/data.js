let monthsEl = document.getElementsByClassName("months");

for (const month of monthsEl) {
  month.addEventListener("click", function () {
    console.log(month);

    const monthName = month.getAttribute("month");
    console.log(monthName);

    const tableMonth = document.getElementById(monthName);
    console.log(tableMonth);

    tableMonth.style.display =
      tableMonth.style.display === "none" ? "" : "none";
  });
}
