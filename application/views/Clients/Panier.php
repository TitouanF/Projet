<div>
    <div>
        <div> 
            <?php echo $this->cart->total_items();?> articles
            <?php if($this->cart->contents()):?>
                <table>
                    <tr>
                        <th> Article</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th colspan="2">Update-Delete</th>
                    </tr>
                    <?php foreach($this->cart->contents() as $art):?>
                    <?php echo form_open('Client/update');?>
                    <input type="hidden" name="rowid" id="rowid" value="<?php echo $art['rowid'];?>"/>
                        <tr>
                        <td> <?php echo $art['name'];?></td>
                        <td> <?php echo $art['price'];?></td>
                        <td><input type="text" name="quantity" value="<?php echo $art['qty'];?>" style="width:30px"/></td>
                        <td><?php echo $art['price'] * $art['qty'];?></td>
                        <td><input type="submit" value="Update"/></td>
                        <td><a class="delete" href="<?php echo site_url('Client/supprimer/'.$art['rowid']);?>">X</a></td>
                        </tr>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                 
                </table>              
                <div> <?php echo $this->cart->total();?> Euros </div>
                
                <input type="submit" value="Valider commande"/>
                <div><a href="<?php echo site_url('Client/ViderPanier');?>"> Vider le panier</a></div>
                <?php else:?>
                <p> Aucun article dans le panier </p>
            <?php endif;?>
        </div>
    </div>
</div>
        