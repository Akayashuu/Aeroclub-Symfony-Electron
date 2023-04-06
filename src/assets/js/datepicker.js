import bulmaCalendar from "bulma-calendar";
import {} from "bulma-calendar"


// Récupérer tous les éléments de formulaire avec le type "date"
var dateInputs = document.querySelectorAll('[type="date"]');

// Boucle sur tous les éléments de formulaire avec le type "date"
for (var i = 0; i < dateInputs.length; i++) {
  var calendar = bulmaCalendar.attach(dateInputs[i], {
        dateFormat: 'yyyy-MM-dd',
        color: 'primary',
        isRange: false,
        allowSameDayRange: true,
        lang: 'fr-FR',
        startDate: undefined,
        endDate: undefined,
        minDate: null,
        maxDate: null,
        disabledDates: [],
        disabledWeekDays: undefined,
        highlightedDates: [],
        weekStart: 0,
        enableMonthSwitch: true,
        enableYearSwitch: true,
        displayYearsCount: 50,
        displayMode:"dialog",
  });
}


