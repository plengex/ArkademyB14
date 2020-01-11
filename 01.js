function biodata(name, age) {
    if (typeof name == "string" && typeof age == "number") {
        let biodata = {
            "name" : name,
            "age" : age,
            "address" : "Jl. Manggis 62A Gaten RT 06 RW 28",
            "hobbies" : [
                "travelling",
                "browsing",
                "coding"
            ],
            "is_married" : false,
            "list_school" : [{
                "name" : "MTs Darul Ulum",
                "year_in" : "2009",
                "year_out" : "2012",
                "major" : null
            }, {
                "name" : "MA Unggulan Darul Ulum",
                "year_in" : "2012",
                "year_out" : "2015",
                "major" : "Science"
            }, {
                "name" : "UIN Sunan Kalijaga",
                "year_in" : "2016",
                "year_out" : "2020",
                "major" : "Informatics"
            }],
            "skills" : [{
                "skill_name" : "HTML",
                "level" : "advanced"
            }, {
                "skill_name" : "JavaScript",
                "level" : "beginer"
            }],
            "interest_in_coding" : true
        }
        return ({"status": true, "data": biodata});
    } else {
        let error = "";

        if (typeof name != "string" && typeof age != "number") {
            error = "name and age is not valid";
        } else if (typeof name != "string") {
            error = "name is not string!";
        } else {
            error = "age is not number!";
        }

        return (
            {"status": false,
            "error": error} 
        );
    }
}