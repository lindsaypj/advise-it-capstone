<?php
if (isset($lastUpdated) && !empty($lastUpdated)) {
    echo
        '<div class="float-centered text-center mt-2 saved">
                <span class="d-block text-dark">
                    <h4>Last Saved: '.$lastUpdated.'</h4>
                </span>
            </div>';
}
else if (isset($lastUpdatedWinter) && !empty($lastUpdatedWinter)) {
    echo '<div class="float-centered text-center mt-2 saved d-none">
                    <span class="d-block text-dark">
                            <h4>Last Saved: '.$lastUpdatedWinter.'</h4>
                    </span>
                </div>';
}
else if (isset($lastUpdatedSpring) && !empty($lastUpdatedSpring)) {
    echo '<div class="float-centered text-center mt-2 saved d-none">
                    <span class="d-block text-dark">
                            <h4>Last Saved: '.$lastUpdatedSpring.'</h4>
                    </span>
                </div>';
}
else if (isset($lastUpdatedFall) && !empty($lastUpdatedFall)) {
    echo '<div class="float-centered text-center mt-2 saved d-none">
                    <span class="d-block text-dark">
                            <h4>Last Saved: '.$lastUpdatedFall.'</h4>
                    </span>
                </div>';
}
