window.addEventListener('load', function() {
	setupTableSorting();
}, false);
function setupTableSorting() {
	// get all the tables where property 'sort' is true
	tables = $$('table[sort="true"]');
	tables.each(function(table) {
		// get all the <th> elements for the table
		thTags = table.getElements('th');
		parsers = new Array();
		// for each <th> element in the table
		thTags.each(function(th) {
			// get the value of the 'sort' property of the <th> element and add it to the parsers array
			// unset sort property means try to automatically determine the parser to use (null gets added as element of parsers array)
			// behavior in the case of <th colspan="x">, where x > 1, is undefined
			parsers.push(th.get('sort'));
			// set the <th> pointer style to 'cursor'
			th.style.cursor = 'pointer';
		});
		// for this to work there must be an explicit <thead> and </thead> in the HTML
		// setting sortIndex to null means do not do initial sort when loading the table
		x = new HtmlTable(table, {sortable: true, parsers: parsers, sortIndex: null, zebra: true});
	});
}