$(function () {
    //
    // Table tree
    //

    $(".tree-table").fancytree({
        extensions: ["table"],
        checkbox: true,
        table: {
            indentation: 20, // indent 20px per node level
            nodeColumnIdx: 2, // render the node title into the 2nd column
            checkboxColumnIdx: 0  // render the checkboxes into the 1st column
        },
        source: {
            url: "assets/demo_data/fancytree/fancytree.json"
        },
        lazyLoad: function (event, data) {
            data.result = {url: "ajax-sub2.json"}
        },
        renderColumns: function (event, data) {
            var node = data.node,
                    $tdList = $(node.tr).find(">td");

            // (index #0 is rendered by fancytree by adding the checkbox)
            $tdList.eq(1).text(node.getIndexHier()).addClass("alignRight");

            // (index #2 is rendered by fancytree)
            $tdList.eq(3).text(node.key);
            $tdList.eq(4).addClass('text-center').html("<input type='checkbox' class='styled' name='like' value='" + node.key + "'>");

            // Style checkboxes
            $(".styled").uniform({radioClass: 'choice'});
        }
    });

    // Handle custom checkbox clicks
    $(".tree-table").delegate("input[name=like]", "click", function (e) {
        var node = $.ui.fancytree.getNode(e),
                $input = $(e.target);
        e.stopPropagation(); // prevent fancytree activate for this row
        if ($input.is(":checked")) {
            alert("like " + $input.val());
        }
        else {
            alert("dislike " + $input.val());
        }
    });
});