<input type="hidden" name="count" value="<?=count($assignments)?>" id="count">
<?php 
foreach($assignments as $assignment){
?>
            <tr class="align-middle">
                <td><?=$assignment['name']?></td>
                <td><?=$assignment['sequence_no']?></td>
                <td><?=$assignment['level']?></td>
                <td><?=$assignment['track']?></td>
            </tr>
<?php
}
?>