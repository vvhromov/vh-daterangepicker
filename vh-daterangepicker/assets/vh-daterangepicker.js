// ----------------------------------------------------------------------------------------------------------------------------
// https://vahro.ru
// 
// Выбор даты daterangepicker
// работает вместе с 
// moment.js
// daterangepicker.js
// 
// ----------------------------------------------------------------------------------------------------------------------------
jQuery( function( $ ) {

  let ru_locale = {     // объект
    // "format": "MM/DD/YYYY",
    "format": "DD-MM-YYYY",
    // "separator": " - ",
    // "applyLabel": "Применить",
    // "cancelLabel": "Отмена",
    // "fromLabel": "От",
    // "toLabel": "До",
    // "customRangeLabel": "Свой диапазон",
    "daysOfWeek": [
        "Вс",
        "Пн",
        "Вт",
        "Ср",
        "Чт",
        "Пт",
        "Сб"
    ],
    "monthNames": [
        "Январь",
        "Февраль",
        "Март",
        "Апрель",
        "Май",
        "Июнь",
        "Июль",
        "Август",
        "Сентябрь",
        "Октябрь",
        "Ноябрь",
        "Декабрь"
    ],
    // "firstDay": 1
  };


  $('label#datepickerlabel').daterangepicker( {
    opens: "center", // daterangepicker откроется по центру html элемента к которому он привязан
    singleDatePicker: true, // показывается 1 календарь
    showDropdowns: true, // выбор месяца и года
    autoApply: true, // не показываются кнопки apply и cancel, выбор даты после клика на число
    "locale": ru_locale, // локализация
  }, 
  function(start, end, label) {
    // выбранная дата устанавливается в поле input[name="date"]
    // и генерируется submit формы
    // формат даты 'MM/DD/YYYY' выбран для установки даты в daterangepicker после перегрузки страницы
    // $( 'input[name="date"]' ).val( start.format('MM/DD/YYYY') );
    $( 'input[name="date"]' ).val( start.format('DD-MM-YYYY') );
    $('form#vh-daterangepicker').submit();
  });

  let datepicker_input_date = $('input[name="date"]' ).val();
  if( datepicker_input_date ) {
    var drp = $('label#datepickerlabel').data('daterangepicker');
    drp.setStartDate( datepicker_input_date );
    drp.setEndDate( datepicker_input_date );
  }

}); // jQuery(...