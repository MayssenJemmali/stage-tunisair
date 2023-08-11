// Calendar Config
const config = {
  mode: "range",
};
flatpickr("input[type=date]", config);

// Calendar button
document
  .getElementById("calendar-button")
  .addEventListener("click", function () {
    document.getElementById("departure-date").click();
  });

// Departure Input
const departureInput = document.getElementById("departureInput");
const departureAutocompleteList = document.getElementById(
  "departureAutocompleteList"
);

// Arrival Input
const arrivalInput = document.getElementById("arrivalInput");
const arrivalAutocompleteList = document.getElementById(
  "arrivalAutocompleteList"
);

// Function to update the input field with the selected airport name and IATA code
function selectAirport(inputElement, airportName, iataCode) {
  inputElement.value = `${airportName} - ${iataCode}`;
  inputElement.nextElementSibling.innerHTML = ""; // Clear the suggestions after selection
}

// Function to render the airport suggestions in the list
async function updateAutocomplete(inputElement, autocompleteList) {
  const inputValue = inputElement.value;
  if (inputValue.length < 2) {
    autocompleteList.innerHTML = ""; // Clear the suggestions if input is too short
    return;
  }

  const suggestions = await fetchAirportSuggestions(inputValue);
  autocompleteList.innerHTML = ""; // Clear previous suggestions
  suggestions.forEach((suggestion) => {
    const listItem = document.createElement("li");

    // Create a span element for the airport name
    const nameSpan = document.createElement("span");
    nameSpan.textContent = suggestion.name;
    nameSpan.classList.add("airport-name"); // Add the class for the airport name
    listItem.appendChild(nameSpan);

    // Add a separator between the airport name and IATA code
    listItem.appendChild(document.createTextNode(" - "));

    // Create a span element for the IATA code
    const iataCodeSpan = document.createElement("span");
    iataCodeSpan.textContent = suggestion.iata_code;
    iataCodeSpan.classList.add("iata-code"); // Add the class for the IATA code
    listItem.appendChild(iataCodeSpan);

    autocompleteList.appendChild(listItem);

    // Event listener to handle click on airport suggestion
    listItem.addEventListener("click", () => {
      selectAirport(inputElement, suggestion.name, suggestion.iata_code);
    });
  });
}

// Event listener to trigger the autocomplete on input change for Departure Input
departureInput.addEventListener("input", () => {
  updateAutocomplete(departureInput, departureAutocompleteList);
});

// Event listener to trigger the autocomplete on input change for Arrival Input
arrivalInput.addEventListener("input", () => {
  updateAutocomplete(arrivalInput, arrivalAutocompleteList);
});

// Fetch airport suggestions function
async function fetchAirportSuggestions(inputValue) {
  const url = `https://airlabs.co/api/v9/suggest?q=${inputValue}&api_key=477981b0-1dce-4de2-8d79-4434d621a2f2`;
  const response = await fetch(url);
  const data = await response.json();
  return data.response?.airports || []; // Use optional chaining to check if 'airports' field exists
}

function clearSuggestions(autocompleteList) {
  autocompleteList.innerHTML = "";
}

// Event listener to detect clicks outside the Departure Input and suggestions list
document.addEventListener("click", (event) => {
  if (
    event.target !== departureInput &&
    event.target !== departureAutocompleteList
  ) {
    clearSuggestions(departureAutocompleteList);
  }
});

// Event listener to detect clicks outside the Arrival Input and suggestions list
document.addEventListener("click", (event) => {
  if (
    event.target !== arrivalInput &&
    event.target !== arrivalAutocompleteList
  ) {
    clearSuggestions(arrivalAutocompleteList);
  }
});
