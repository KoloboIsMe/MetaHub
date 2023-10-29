<?php
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////  LOADER  /////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Loads all the needed files.

require 'Controler/Controller.php';
require 'Controler/Presenter.php';

require 'Framework/Database/CategoryAccess.php';
require 'Framework/Database/CommentAccess.php';
require 'Framework/Database/SPDO.php';
require 'Framework/Database/TicketAccess.php';
require 'Framework/Database/UserAccess.php';

require 'Framework/Entity/Category.php';
require 'Framework/Entity/Comment.php';
require 'Framework/Entity/Ticket.php';
require 'Framework/Entity/User.php';

require 'View/Layout.php';
require 'View/View.php';
require 'View/ViewCategories.php';
require 'View/ViewError.php';
require 'View/ViewHomepage.php';
require 'View/ViewLogin.php';
require 'View/ViewRegister.php';
require 'View/ViewTickets.php';

require 'Model/CategoriesGetting.php';
require "Model/CommentsGetting.php";
require "Model/OutputData.php";
require "Model/TicketsGetting.php";
require "Model/UsersGetting.php";