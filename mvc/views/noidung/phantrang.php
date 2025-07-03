<div class="container mt-2">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php if ($sotrang > 3) {
                if ($tranght - 3 >= 1) { ?>
                    <li class="page-item ">
                        <?php
                        if ($data['check'] == 1) { ?>
                            <a class="page-link" href="./home/chi_tiet_loaisach/<?php echo $id ?>/1 " tabindex="1">Trang đầu</a>
                        <?php } else if ($data['check'] == 2) {  ?>
                            <a class="page-link" href="./home/timkiem/1/?q=<?php echo $tensach ?> " tabindex="1">Trang đầu</a>
                        <?php } 
                             else if ($data['check'] == 3) { ?>
                             <a class="page-link" href="./home/chi_tiet_khoacn/<?php echo $id ?>/1 " tabindex="1">Trang đầu</a>
                        <?php } 
                        else { ?>
                            <a class="page-link" href="./home/sayhi/1 " tabindex="1">Trang đầu</a>
                        <?php } ?>
                    </li>
                    <li class="page-item"><i class="page-link">....</i></li>
            <?php }
            }
            ?>

            <?php if ($data['check'] == 1) {
                for ($i = 1; $i <= $sotrang; $i++) {
                    if ($i > $tranght - 3 && $i < $tranght + 3) { ?>

                        <li class="page-item"><a <?php if ($i == $tranght) echo "style='background-color:#C1FFC1 ;' "; ?> class="page-link" href="./home/chi_tiet_loaisach/<?php echo $data["id"] ?>/<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php
                    }
                }
            } else if ($data['check'] == 0) {
                for ($i = 1; $i <= $sotrang; $i++) {
                    if ($i > $tranght - 3 && $i < $tranght + 3) { ?>
                        <li class="page-item"><a <?php if ($i == $tranght) echo "style='background-color:#C1FFC1 ;' "; ?> class="page-link" href="./home/sayhi/<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php
                    }
                }
            } else if ($data['check'] == 2) {
                for ($i = 1; $i <= $sotrang; $i++) {
                    if ($i > $tranght - 3 && $i < $tranght + 3) { ?>
                        <li class="page-item"><a <?php if ($i == $tranght) echo "style='background-color:#C1FFC1 ;' "; ?> class="page-link" href="./home/timkiem/<?php echo $i ?>/?q=<?php echo $tensach ?>"><?php echo $i ?></a></li>
            <?php }
                }
            } 
            else if ($data['check'] == 3) {
                for ($i = 1; $i <= $sotrang; $i++) {
                    if ($i > $tranght - 3 && $i < $tranght + 3) { ?>
                    <li class="page-item"><a <?php if ($i == $tranght) echo "style='background-color:#C1FFC1 ;' "; ?> class="page-link" href="./home/chi_tiet_khoacn/<?php echo $data["id"] ?>/<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php } 
                }
            }
            ?>

            

            <?php if ($sotrang > 3) {
                if ($tranght + 2 < $sotrang) { ?>
                    <li class="page-item"><i class="page-link">....</i></li>
                    <li class="page-item">
                        <?php
                        if ($data['check'] == 1) { ?>
                            <a class="page-link" href="./home/chi_tiet_loaisach/<?php echo $id ?>/<?php echo $sotrang ?>">Trang cuối</a>
                        <?php }
                        else if($data['check'] == 2){ ?>
                             <a class="page-link" href="./home/timkiem/<?php echo $sotrang ?>/?q=<?php echo $tensach ?>">Trang cuối</a>
                        <?php }
                          else if($data['check'] == 3){ ?>
                                <a class="page-link" href="./home/chi_tiet_khoacn/<?php echo $id ?>/<?php echo $sotrang ?>">Trang cuối</a>
                        <?php } 
                         else { ?>
                            <a class="page-link" href="./home/sayhi/<?php echo $sotrang ?>">Trang cuối</a>
                        <?php  } ?>
                    </li>

            <?php  }
            }
            ?>
        </ul>
    </nav>
</div>