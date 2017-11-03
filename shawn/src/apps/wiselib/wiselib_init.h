/************************************************************************
 ** This file is part of the network simulator Shawn.                  **
 ** Copyright (C) 2004-2007 by the SwarmNet (www.swarmnet.de) project  **
 ** Shawn is free software; you can redistribute it and/or modify it   **
 ** under the terms of the BSD License. Refer to the shawn-licence.txt **
 ** file in the root of the Shawn source tree for further details.     **
 ************************************************************************/
#ifndef __SHAWN_APPS_WISELIB_WISELIB_INIT_H__
#define __SHAWN_APPS_WISELIB_WISELIB_INIT_H__

#include "_apps_enable_cmake.h"
#ifdef ENABLE_WISELIB

namespace shawn
{ 
	class SimulationController; 
}

/** This method is invoked by Shawn to initialize the current module
  */
extern "C" void init_wiselib( shawn::SimulationController& );


#endif
#endif
/*-----------------------------------------------------------------------
 * Source  $Source: /cvs/shawn/shawn/apps/exampletask/exampletask_init.h,v $
 * Version $Revision: 197 $
 * Date    $Date: 2008-04-29 17:40:51 +0200 (Di, 29 Apr 2008) $
 *-----------------------------------------------------------------------
 * $Log: exampletask_init.h,v $
 *-----------------------------------------------------------------------*/
