let values = [];

function handleInput(event) {
  if (event.key === "Enter") {
    const value = event.target.value.trim();
    if (value !== "") {
      values.push(value);
      displayValues();
      event.target.value = "";
    }
    event.preventDefault();
  }
}

function displayValues() {
  const valuesContainer = document.getElementById("valuesContainer");
  valuesContainer.innerHTML = "";
  values.forEach((value, index) => {
    const badge = document.createElement("span");
    badge.textContent = value;

    badge.style.padding = "2px 10px";
    badge.style.marginLeft = "-70px";
    badge.style.marginTop = "5px";
    badge.style.backgroundColor = "#237e5d";
    badge.style.color = "#ffffff";
    badge.style.borderRadius = "5px";
    badge.style.cursor = "pointer";
    badge.style.display = "inline-block";

    const closeButton = document.createElement("button");
    closeButton.classList.add("close");
    closeButton.setAttribute("type", "button");
    closeButton.setAttribute("aria-label", "Close");
    closeButton.style.backgroundColor = "transparent";
    closeButton.style.fontSize = "13px";
    closeButton.style.border = "none";
    closeButton.style.marginLeft = "6px";

    closeButton.innerHTML = '<i class="fas fa-times" style="color: #fff;"></i>';

    closeButton.addEventListener("click", function () {
      values.splice(index, 1);
      displayValues();
      document.getElementById("filterInput").style.display = "block";
    });

    badge.appendChild(closeButton);
    valuesContainer.appendChild(badge);
  });

  document.getElementById("filterInput").style.display = "none";
}
