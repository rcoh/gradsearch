<li>
    <a href="profile.php?id=<?php echo $row['id']; ?>" class="prof_box">
        <div class="prof_image">
            <img class="thumbnail" src="<?php echo $row['image']; ?>" alt="">
        </div>
        <div class="prof_info">
            <div id="stars">
                <img class="gold_star" src="gold_star.png">
                <img class="gray_star" src="gray_star.png">
            </div>
            <h5><?php echo $row['name']; ?></h5>
            <p><?php echo $row['school']; ?></p>
            <p><?php echo $row['department'] ?></p>
            <hr>
            <p>
    <?php echo research_interests_str($row['id'], $con, $query); ?>
            </p>
        </div>
    </a>
</li>
