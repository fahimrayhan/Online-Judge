<style type="text/css">
/*.form-label-group input::-webkit-input-placeholder {
  color: transparent;
}

.form-label-group input:-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-moz-placeholder {
  color: transparent;
}
*/

.form-label-group input::placeholder {
  color: transparent;
}

:root {
  --input-padding-x: 16px;
  --input-padding-y: .75rem;
}
.form-signup {
  width: 100%;
  max-width: 420px;
  padding: 15px;
  margin: 0 auto;
}

.form-label-group {
  position: relative;
  margin-bottom: 1rem;
}


.form-label-group > label {
  padding: var(--input-padding-x) 5px var(--input-padding-x) 5px;
}

.form-label-group > label {
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 100%;
  margin-bottom: 0; /* Override default `<label>` margin */
  line-height: 1.5;
  color: #A59CA5;
  border: 1px solid transparent;
  border-radius: .25rem;
  transition: all .1s ease-in-out;
  font-family: "Exo 2";
}


.form-label-group input:not(:placeholder-shown) {
  padding: 27px 5px 5px 10px;
}

.form-label-group input:focus {
  padding: 27px 5px 5px 10px;
}
.form-label-group input:focus ~ label {
  padding-top: 5px;
  
  font-size: 13px;
  color: #A59CA5;
}

.form-label-group input:not(:placeholder-shown) ~ label {
  padding-top: 5px;
  
  font-size: 13px;
  color: #A59CA5;
}


.custom-form-input{
	padding: var(--input-padding-x) 5px var(--input-padding-x) 5px;
	width: 80%;
	border: 1px solid #d4d4d4;
	border-radius: 5px;
	cursor:pointer!important;
}
.form-label-group label:hover{
	cursor: text;
}
.custom-form-input:focus{
	outline: none;
}


.field {
  display: flex;
  flex-flow: column-reverse;
  margin-bottom: 1em;
}



.field {
  display: flex;
  flex-flow: column-reverse;
  margin-bottom: 1em;
}
/**
* Add a transition to the label and input.
* I'm not even sure that touch-action: manipulation works on
* inputs, but hey, it's new and cool and could remove the 
* pesky delay.
*/
label, input {
  transition: all 0.2s;
  touch-action: manipulation;
}

input {
  font-size: 1.5em;
  border: 0;
  border-bottom: 1px solid #ccc;
  font-family: inherit;
  -webkit-appearance: none;
  border-radius: 0;
  padding: 0;
  cursor: text;
}

input:focus {
  outline: 0;
  border-bottom: 1px solid #666;
}

label {
  /*text-transform: uppercase;*/
  letter-spacing: 0.05em;
}
/**
* Translate down and scale the label up to cover the placeholder,
* when following an input (with placeholder-shown support).
* Also make sure the label is only on one row, at max 2/3rds of the
* field—to make sure it scales properly and doesn't wrap.
*/
input:placeholder-shown + label {
  cursor: text;
  max-width: 66.66%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  transform-origin: left bottom;
  transform: translate(0, 3.725rem) scale(1.5);
}
/**
* By default, the placeholder should be transparent. Also, it should 
* inherit the transition.
*/
::-webkit-input-placeholder {
  opacity: 0;
  transition: inherit;
}
/**
* Show the placeholder when the input is focused.
*/
input:focus::-webkit-input-placeholder {
  opacity: 1;
}
/**
* When the element is focused, remove the label transform.
* Also, do this when the placeholder is _not_ shown, i.e. when 
* there's something in the input at all.
*/
input:not(:placeholder-shown) + label,
input:focus + label {
  transform: translate(0, 0) scale(1);
  cursor: pointer;
}

