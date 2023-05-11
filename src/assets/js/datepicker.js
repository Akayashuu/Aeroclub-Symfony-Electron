import bulmaCalendar from "bulma-calendar";

var datetimeInputs = document.querySelectorAll('[type="datetime-local"]');
for (var i = 0; i < datetimeInputs.length; i++) {
    let t = null 
    if(datetimeInputs[i].value) {
       t = new Date(datetimeInputs[i].value);
    }
    var calendar = bulmaCalendar.attach(datetimeInputs[i], {
        dateFormat: 'yyyy-MM-dd',
        timeFormat: 'HH:mm',
        color: 'primary',
        isRange: false,
        allowSameDayRange: true,
        lang: 'fr-FR',
        minDate: null,
        maxDate: null,
        startDate:t,
        startTime:t, 
        disabledDates: [],
        disabledWeekDays: undefined,
        highlightedDates: [],
        weekStart: 0,
        enableMonthSwitch: true,
        enableYearSwitch: true,
        displayYearsCount: 50,
        displayMode: "dialog",
        type: 'datetime'
    });
}