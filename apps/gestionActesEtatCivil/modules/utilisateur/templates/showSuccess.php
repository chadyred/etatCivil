<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $utilisateur->getId() ?></td>
    </tr>
    <tr>
      <th>Login:</th>
      <td><?php echo $utilisateur->getLogin() ?></td>
    </tr>
    <tr>
      <th>Password:</th>
      <td><?php echo $utilisateur->getPassword() ?></td>
    </tr>
    <tr>
      <th>Nom:</th>
      <td><?php echo $utilisateur->getNom() ?></td>
    </tr>
    <tr>
      <th>Prenom:</th>
      <td><?php echo $utilisateur->getPrenom() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('utilisateur/edit?id='.$utilisateur->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('utilisateur/index') ?>">List</a>
