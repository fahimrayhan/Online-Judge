var currentOrder = [];

$(function() {
    var $srcElement;
    var srcIndex, dstIndex;
    $("#list>li").dragdrop({
        makeClone: true,
        sourceHide: true,
        dragClass: "shadow",
        canDrag: function($src, event) {
            $srcElement = $src;
            srcIndex = $srcElement.index();
            dstIndex = srcIndex;
            return $src;
        },
        canDrop: function($dst) {
            if ($dst.is("li")) {
                dstIndex = $dst.index();
                if (srcIndex < dstIndex) $srcElement.insertAfter($dst);
                else $srcElement.insertBefore($dst);
            }
            return true;
        },
        didDrop: function($src, $dst) {
            // Must have empty function in order to NOT move anything.
            // Everything that needs to be done has been done in canDrop.
            if (srcIndex != dstIndex) {
                var value = currentOrder[srcIndex];
                currentOrder.splice(srcIndex, 1);
                currentOrder.splice(dstIndex, 0, value);
                console.log(currentOrder);
                updateFormSerial();
            }
        }
    });
});



function updateFormSerial() {
    $.post("contest_arena_action.php", { 'updateFormSerial': JSON.stringify(currentOrder)}, function(response) {
        $("#server-results").html(response);
        $("#msg").text("New order of items:" + currentOrder.join(", "));
    });
}