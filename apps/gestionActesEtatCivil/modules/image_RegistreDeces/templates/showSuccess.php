<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $image_registre_deces->getId() ?></td>
    </tr>
    <tr>
      <th>Deces:</th>
      <td><?php echo $image_registre_deces->getDecesId() ?></td>
    </tr>
    <tr>
      <th>Nom image:</th>
      <td><?php echo $image_registre_deces->getNomImage() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('image_RegistreDeces/edit?id='.$image_registre_deces->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('image_RegistreDeces/index') ?>">List</a>
