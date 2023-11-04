<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  LOADER  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Loads all the needed files.
/// TO DO : Create a recursive generic class loader

require 'constants.php';
require 'functions.php';

$repositoryDirectory = __DIR__ . '/../../Repository';
require "$repositoryDirectory/Connexion.php";
require "$repositoryDirectory/Record.php";

require "$repositoryDirectory/Entity/ID.php";
require "$repositoryDirectory/Entity/tuple.php";
require "$repositoryDirectory/Entity/Entity.php";
require "$repositoryDirectory/Entity/Categorized.php";
require "$repositoryDirectory/Entity/Category.php";
require "$repositoryDirectory/Entity/Comment.php";
require "$repositoryDirectory/Entity/Ticket.php";
require "$repositoryDirectory/Entity/User.php";

require "$repositoryDirectory/Table/BasicTable.php";
require "$repositoryDirectory/Table/IdentifiedTable.php";
require "$repositoryDirectory/Table/CategorizedTable.php";
require "$repositoryDirectory/Table/CategoryTable.php";
require "$repositoryDirectory/Table/CommentTable.php";
require "$repositoryDirectory/Table/TicketTable.php";
require "$repositoryDirectory/Table/UserTable.php";

require __DIR__ . '/../Object/Card.php';

require 'singletons.php';

return;