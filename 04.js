function findSame(arr=[]) {
	var anagrams1 = [];
	var anagrams2 = new Array();
	for (let i=0; i<arr.length; i++) {
		var word1 = arr[i];
		var word2 = word1.match(/[a-zA-Z]/g).sort();

		if (anagrams1[word2] != null) {
			anagrams1[word2].push(word1);
		}
		else {
			anagrams1[word2] = [word1];
		}
	}

	for (var key in anagrams1) {
		if (anagrams1[key].length !== 1) {
			anagrams2.push(anagrams1[key].join(", "));
		}
	}

	if (anagrams2.length === 0) {
		return console.log("Tidak ditemukan!");
	}
	else {
		return console.log(anagrams2.join("\n"));
	}
}

findSame(["cat", "listen", "code", "act", "silent", "tac"]);
findSame(["try", "fire", "dark"]);