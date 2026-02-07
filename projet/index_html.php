<div class="display_flex">
    <?php

    if ($mes_projet_parent[0]["use_html_project_name"] == 0) {
        echo '<div>' . $name_projet . '</div>';
    } else {

        echo '<div>' . $name_projet_n . '</div>';
    }
    ?>
</div>

<div class="description_projet">
    <?php

    if ($mes_projet_parent[0]["use_html_description_projet"] == 0) {
        echo '<div>' . $description_projet . '</div>';
    } else {
        echo '<div>' . $description_projet_n . '</div>';
    }
    ?>
</div>