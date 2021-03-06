<style>
    section {
  counter-reset: total;
}

input {
  opacity: 0;
  position: absolute;
}

label {
  position: relative;
  display: block;
  background: #f8f8f8;
  border: 1px solid #f0f0f0;
  border-radius: 2em;
  padding: .5em 1em .5em 5em;
  box-shadow: 0 1px 2px rgba(100, 100, 100, 0.5) inset, 0 0 10px rgba(100, 100, 100, 0.1) inset;
  cursor: pointer;
  text-shadow: 0 2px 2px #fff;
}
label::before {
  content: '';
  position: absolute;
  top: 50%;
  left: .7em;
  width: 3em;
  height: 1.2em;
  border-radius: .6em;
  background: #eee;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  box-shadow: 0 1px 3px rgba(100, 100, 100, 0.5) inset, 0 0 10px rgba(100, 100, 100, 0.2) inset;
}
label::after {
  content: '';
  position: absolute;
  top: 50%;
  left: .5em;
  width: 1.4em;
  height: 1.4em;
  border: .25em solid #fafafa;
  border-radius: 50%;
  box-sizing: border-box;
  background-color: #ddd;
  background-image: linear-gradient(to top, #fff 0%, #fff 40%, transparent 100%);
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  box-shadow: 0 3px 3px rgba(0, 0, 0, 0.5);
}
label, label::before, label::after {
  transition: all 0.2s cubic-bezier(0.165, 0.84, 0.44, 1);
}

label:hover, input:focus + label {
  color: black;
}
label:hover::after, input:focus + label::after {
  background-color: #ccc;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
}

input:checked {
  counter-increment: total;
}
input:checked + label::before {
  background: #1CE;
}
input:checked + label::after {
  -webkit-transform: translateX(2em) translateY(-50%);
          transform: translateX(2em) translateY(-50%);
}

.total::after {
  content: counter(total);
  font-weight: bold;
}

/* misc */
html, body {
  height: 100%;
}

body {
  display: flex;
  background: #eee;
}

section {
  margin: auto;
  padding: 2em;
  background: white;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

div {
  margin: 1em 0;
  font: 1.5em/1.4 'Open Sans Condensed', sans-serif;
  color: #777;
}

    </style>

<section>
	<div>
		<input id="chk01" type="checkbox" />
		<label for="chk01">Lorem ipsum dolor sit amet.</label>
	</div>
	<div>
		<input id="chk02" type="checkbox" />
		<label for="chk02">Eos voluptate, impedit porro iusto.</label>
	</div>
	<div>
		<input id="chk03" type="checkbox" />
		<label for="chk03">Ipsum, distinctio? Odio, delectus, maiores.</label>
	</div>
	<div>
		<input id="chk04" type="checkbox" />
		<label for="chk04">Sint maxime ex nisi iste!</label>
	</div>
	<div>
		<input id="chk05" type="checkbox" />
		<label for="chk05">Quisquam, ipsam autem veniam libero!</label>
	</div>
	<div class="total">
		Total checked: 
	</div>
</section>