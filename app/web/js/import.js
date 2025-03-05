// $(document).ready(function() {
//     // Периодическое обновление каждые 10 секунд (10000 миллисекунд)
//     setInterval(function() {
//         $.ajax({
//             url: '/admin/import/process',
//             type: 'GET',
//             success: function(response) {
//                 $('#process').html(response);
//             },
//             error: function(xhr, status, error) {
//                 console.error('Ошибка: ' + xhr.statusText);
//             }
//         });
//     }, 1000); // Указываем интервал в миллисекундах
// });

$(document).ready(function() {
   
    setInterval(function() {
        $.getJSON('http://212.67.12.21/import.json', function(data) {
            if (data.status === "run") 
            {
                $.ajax({
                    url: '/admin/import/process',
                    type: 'GET',
                    success: function(response) {
                        $('#process').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Ошибка: ' + xhr.statusText);
                    }
                });
            }
        })
    }, 1000);
});


