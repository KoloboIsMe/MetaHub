<?php

///////////////////////////////////////////////////////////////////////////////
///////////////////////// INITIALIZATION FILE /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
/// Load all classes and instantiates every Singleton

include 'controls/Controller.php';
include 'controls/Presenter.php';

include 'database/CategoryAccess.php';
include 'database/CommentAccess.php';
include 'database/SPDO.php';
include 'database/TicketAccess.php';
include 'database/UserAccess.php';

include 'entities/Category.php';
include 'entities/Comment.php';
include 'entities/Ticket.php';
include 'entities/User.php';

include 'View/Layout.php';
include 'View/View.php';
include 'View/ViewCategories.php';
include 'View/ViewError.php';
include 'View/ViewHomepage.php';
include 'View/ViewLogin.php';
include 'View/ViewRegister.php';
include 'View/ViewTickets.php';

include 'Model/CategoriesGetting.php';
include "Model/CommentsGetting.php";
include "Model/OutputData.php";
include "Model/TicketsGetting.php";
include "Model/UsersGetting.php";