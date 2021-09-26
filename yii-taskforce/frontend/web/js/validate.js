// Устаревшие браузеры поддерживают несколько способов получения DOM-узла
const form  = document.getElementsByTagName('form')[0];
const email = document.getElementById('loginform-email');

// Ниже приведён способ получения узла следующего родственного DOM-элемента
// Он опасен, потому что можно создать бесконечный цикл.
// В современных браузерах лучше использовать `element.nextElementSibling`
let error = email;
while ((error = error.nextSibling).nodeType != 1);

// Согласно спецификации HTML5
const emailRegExp = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

// Многие устаревшие браузеры не поддерживают метод `addEventListener`
// Есть простой способ заменить его; и далеко не единственный
function addEvent(element, event, callback) {
  let previousEventCallBack = element["on"+event];
  element["on"+event] = function (e) {
    const output = callback(e);

    // Колбэк, который возвращает `false`, останавливает цепочку колбэков
    // и прерывает выполнение колбэка события
    if (output === false) return false;

    if (typeof previousEventCallBack === 'function') {
      output = previousEventCallBack(e);
      if(output === false) return false;
    }
  }
};

// Теперь мы можем изменить наши критерии валидации
// Поскольку мы не полагаемся на CSS-псевдокласс, для поля email
// нужно явно задать валидный / не валидный класс
addEvent(window, "load", function () {
  // Проверка, является ли поле пустым (помните, оно не являтеся обязательным)
  // Если поле не пустое, проверяем содержимое на соответствует шаблону email
  const test = email.value.length === 0 || emailRegExp.test(email.value);

  email.className = test ? "valid" : "invalid";
});

// Здесь определяется поведение при вводе пользователем значения поля
addEvent(email, "input", function () {
  const test = email.value.length === 0 || emailRegExp.test(email.value);
  if (test) {
    email.className = "valid";
    error.textContent = "";
    error.className = "error";
  } else {
    email.className = "invalid";
  }
});

// Здесь определяется поведение при попытке отправить данные
addEvent(form, "submit", function () {
  const test = email.value.length === 0 || emailRegExp.test(email.value);

  if (!test) {
    email.className = "invalid";
    error.textContent = "I expect an e-mail, darling!";
    error.className = "error active";

    // Некоторые устаревшие браузеры не поддерживают метод event.preventDefault()
    return false;
  } else {
    email.className = "valid";
    error.textContent = "";
    error.className = "error";
  }
});
