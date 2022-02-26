<?php
    switch(rand(0, 5)){
        case 0:
            echo "style='background: #59C173;
                    background: -webkit-linear-gradient(to right, #5D26C1, #a17fe0, #59C173);
                    background: linear-gradient(to right, #5D26C1, #a17fe0, #59C173);'";
            break;
        case 1:
            echo "style='background: #00F260;
                    background: -webkit-linear-gradient(to right, #0575E6, #00F260);
                    background: linear-gradient(to right, #0575E6, #00F260);'";
            break;
        case 2:
            echo "style='background: #EB5757;
                    background: -webkit-linear-gradient(to right, #000000, #EB5757);
                    background: linear-gradient(to right, #000000, #EB5757);'";
            break;
        case 3:
            echo "style='background: #F3904F;
                    background: -webkit-linear-gradient(to right, #3B4371, #F3904F);
                    background: linear-gradient(to right, #3B4371, #F3904F);'";
            break;
        case 4:
            echo "style='background: #5A3F37;
                    background: -webkit-linear-gradient(to right, #2C7744, #5A3F37);
                    background: linear-gradient(to right, #2C7744, #5A3F37);'";
            break;
        case 5:
            echo "style='background: #5D4157;
                    background: -webkit-linear-gradient(to right, #A8CABA, #5D4157);
                    background: linear-gradient(to right, #A8CABA, #5D4157);'";
            break;
        default:
            echo "style='background: #CCAAFF'";
            break;
    }
?>