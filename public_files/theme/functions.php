<?php

function showAlert($mode, $text) {
    echo '<div class="alert alert-' . $mode . ' alert-dismissable fade in">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $text . '</div>';
}
