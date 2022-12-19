let buttons = document.getElementById('buttonsM');

let formHome = document.getElementById('formHome');
let formPick = document.getElementById('formPick');
let formsDiv = document.getElementById('forms');

let userPart = document.getElementById('userPart');
let userPartPick = document.getElementById('userPartPick');
let pedidoPart = document.getElementById('pedidoPart');
let prodPart = document.getElementById('prodPart');
let prodPartPick = document.getElementById('prodPartPick');

let nombreField = document.getElementById('nombre');
let nombreFieldPick = document.getElementById('nombrePick');
let tlfField = document.getElementById('tlf');
let tlfFieldPick = document.getElementById('tlfPick');
let dirField = document.getElementById('dir');

let nombreLabel = document.getElementById('nombreLabel');
let nombreLabelPick = document.getElementById('nombreLabelPick');
let tlfLabel = document.getElementById('tlfLabel');
let tlfLabelPick = document.getElementById('tlfLabelPick');
let dirLabel = document.getElementById('dirLabel');


let cardCB = document.getElementById('card');
let cambCB = document.getElementById('camb');
let checkBoxes = Array.from(document.getElementsByClassName('checks'));
let cantidades = Array.from(document.getElementsByClassName('cantidades'));

let nombreRegex = /^[a-zA-Z]{4,10}$/;
let tlfRegex = /^(\+[\d]{1,5})?[\d]{4,15}$/;

