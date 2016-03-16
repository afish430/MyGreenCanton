
function showTip(){
    var tipsArray = [
		"Receive and pay your bills online instead of using paper mail",
        "Reuse office printouts as notepads",
        "Use organic and biodegradable soaps and skin products.",
        "Turn the lights out when leaving a room",
        "Support local farming by visiting famer's markets and co-ops",
        "Borrow books from your local library instead of buying them new",
        "Recycle used tires as swings or mini gardens",
        "Suspend newspaper delivery when you are out of town",
		"Recycle used motor oil properly at services stations or repair facilities",
        "Use soft baby wash cloths for face cleaning, rather than disposable cotton balls",
        "Use glass for food storage instead of chemical-containing plastics",
        "Ask your teachers if homework can be submitted by email rather than paper",
        "Search for durable used sports equipment over lower quality new equipment",
        "Use energy-saving light bulbs and night-lights",
        "Shut your computer down at bedtime to reduce energy use",
        "Inflate your car's tires regularly to improve fuel efficiency",
        "If you live in the city, create a rooftop or urban garden",
        "Organize a community clean-up project",
        "Take showers instead of baths to conserve water",
        "Shovel your snow instead of using gasoline-powered equipment",
        "Educate yourself about environmental justice issues",
        "Avoid buying toys that use harmful chemicals in their plastics",
        "Buy pesticide-free bamboo, hemp, or organic cotton clothing",
        "In the summer, keep your curtains closed to reduce heat in your home",
        "Seal your windows and doors with caulking and weather stripping",
		"Recycle used ink cartridges from your printer at an office supply store",
        "Set your computer to sleep mode instead of constantly running a screen-saver",
        "Buy organic, fair-trade coffee blends",
        "Reuse and recycle everyday items by making them into sustainable art projects",
        "Use an automatic thermostat to turn down your heat when you are at work",
        "Avoid picking wildflowers while hiking; leave them for others to enjoy"
    ]

    var today = new Date();
    var todaysDate = today.getDate()
    var tip = tipsArray[todaysDate-1];
    //document.getElementById("ecoTip").innerHTML = tip;
    document.write(tip);
 }



