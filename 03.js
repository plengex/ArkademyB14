const formatInput = (...args) => {
	let to = args[0].match(/\d/g);

	var sentence = "";
	for (let i=0; i<to.length; i++) {
		sentence += args[parseInt(to[i])+1]+" ";
	}

	let string = args[0].match(/[a-zA-Z ]+/g);
	console.log(string[0]+sentence);
};

formatInput("Hello {0} {1}", "Arkademian", "Fighters!");
formatInput("This is an {2}", "Halangan", "Rintangan", "Exercise");