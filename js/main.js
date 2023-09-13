$(".select__header").on("click", function () {
    $(this).parent().toggleClass("opened")
});

$(".select-ul__item").on("click", function () {
    const $select = $(this).closest(".select");
    
    if ($select.hasClass("multiple")) {
        $(this).toggleClass("selected");
        const selectedItems = $select.find(".select-ul__item.selected");
        const selectedText = selectedItems.map(function () {
            return $(this).text();
        }).get().join(", ");

        if (selectedItems.length === 0) {
            $select.find(".select__heading").text("Выберите один или несколько вариантов");
        } else {
            $select.find(".select__heading").text(selectedText);
        }
    } else {
        if ($select.find(".select-ul__item").hasClass("selected")) {
            $select.find(".select-ul__item").removeClass("selected");
            $select.removeClass("opened");

            $select.find(".select__heading").text("Выберите один вариант"); 
        } else {
            $(this).addClass("selected");
            $select.find(".select__heading").text($(this).text());

            $select.removeClass("opened");
        }
    }
});

$(document).ready(function() {
    $(".form").on("submit", function(event) {
        event.preventDefault(); // Предотвращаем отправку формы по умолчанию

        // Создаем объект для хранения ответов пользователя
        const userData = {};

        // Проходим по каждой форме с классом .form-step
        $(".form-step").each(function(index) {
            const stepTitle = $(this).find(".form-step__title").text().trim();
            let stepData = null;

            // Если есть поле ввода (input или textarea), берем его значение
            const $input = $(this).find("input, textarea");
            if ($input.length) {
                stepData = $input.val();
            }

            // Если есть радиокнопки (input[type=radio]), берем значение выбранной радиокнопки
            const $radio = $(this).find("input[type=radio]:checked");
            if ($radio.length) {
                stepData = $radio.siblings("label").text();
            }

            // Если есть чекбоксы (input[type=checkbox]), берем значения выбранных чекбоксов
            const $checkboxes = $(this).find("input[type=checkbox]:checked");
            if ($checkboxes.length) {
                stepData = $checkboxes.map(function() {
                    return $(this).siblings("label").text();
                }).get();
            }

            // Если есть select, берем выбранный вариант
            const $select = $(this).find(".select__heading");
            if ($select.length) {
                stepData = $select.text().trim();
            }

            // Добавляем ответ пользователя в объект userData
            userData[`Step ${index + 1}: ${stepTitle}`] = stepData;
        });

        // Преобразуем объект userData в JSON
        const userDataJSON = JSON.stringify(userData, null, 2);

        // Выводим JSON с ответами пользователя (вы можете заменить этот код на отправку данных на сервер)
        console.log(userDataJSON);
    });
});


$(".filter-section__header").on("click", function () {
    $(this).parent().toggleClass("opened")
});

$(document).on("click", "[data-link]", function (e) {
    attr = $(this).attr("data-link")

    $(".overlay").addClass("opened")
    $("[data-overlay=" + attr + "]").addClass("opened")
    scrollDisable()
})

$(".overlay-item__close-btn").on("click", function () {
    $(".overlay").removeClass("opened");
    $(".overlay").children(".container").children(".opened").removeClass("opened");

    scrollEnable();
});

function scrollDisable() {
    $("html,body").css("overflow","hidden");
}
function scrollEnable() {
    $("html,body").css("overflow","auto");
}

// Создаем объект с данными для отправки на сервер
var dataToSend = {
    name: "Название задачи",
    description: "Описание задачи",
    place: "Место",
    type: "Тип задачи",
    misc: "Дополнительная информация",
    price: 100, // Пример цены
    status: "Статус задачи",
    owner_id: 1, // ID владельца
    date_ends: "2023-12-31" // Пример даты завершения
};

token = "1234567890:ABCDEFGHIJKLMNOPQRSTUVWXYZ"

$("#form-submit").on("click", function () {
// Отправляем POST-запрос на сервер
$.ajax({
    type: "POST", // Тип запроса
    headers: {
        "Authorization": "Bearer " + token, // Используем заголовок "Authorization" с токеном
    },
    url: "/api/index.php", // Замените на реальный URL вашего серверного скрипта
    data: { method: "postTask", data: dataToSend }, // Данные для отправки
    dataType: "json", // Тип данных, которые ожидаем получить в ответе
    success: function(response) {
        // Обработка успешного ответа от сервера
        alert(response.message);
    },
    error: function(xhr, status, error) {
        // Обработка ошибки при выполнении запроса
        alert("Ошибка при выполнении запроса:", error);
    }
});

return false;
});