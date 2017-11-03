/************************************************************************
 ** This file is part of the network simulator Shawn.                  **
 ** Copyright (C) 2004-2007 by the SwarmNet (www.swarmnet.de) project  **
 ** Shawn is free software; you can redistribute it and/or modify it   **
 ** under the terms of the BSD License. Refer to the shawn-licence.txt **
 ** file in the root of the Shawn source tree for further details.     **
 ************************************************************************/
#include "_legacyapps_enable_cmake.h"
#ifdef ENABLE_MI_APLIC

#include "legacyapps/mi_aplic/mi_aplic_processor_factory.h"
#include "legacyapps/mi_aplic/mi_aplic_processor.h"
#include "sys/processors/processor_keeper.h"
#include "sys/simulation/simulation_controller.h"
#include <iostream>

using namespace std;
using namespace shawn;

namespace mi_aplic
{

   // ----------------------------------------------------------------------
   void
   MiAplicProcessorFactory::
   register_factory( SimulationController& sc )
      throw()
   {
      sc.processor_keeper_w().add( new MiAplicProcessorFactory );
   }
   
   // ----------------------------------------------------------------------
   MiAplicProcessorFactory::
   MiAplicProcessorFactory()
   {
      //cout << "MiAplicProcessorFactory ctor" << &auto_reg_ << endl;
   }
   
   // ----------------------------------------------------------------------
   MiAplicProcessorFactory::
   ~MiAplicProcessorFactory()
   {
      //cout << "MiAplicProcessorFactory dtor" << endl;
   }
   
   // ----------------------------------------------------------------------
   std::string
   MiAplicProcessorFactory::
   name( void )
      const throw()
   { 
	   return "mi_aplic"; 
   }
   
   // ----------------------------------------------------------------------
   std::string 
   MiAplicProcessorFactory::
   description( void )
      const throw()
   {
      return "Demo de un proceso corriendo";
   }
   
   // ----------------------------------------------------------------------
   shawn::Processor*
   MiAplicProcessorFactory::
   create( void )
      throw()
   {
      return new MiAplicProcessor;
   }

}

#endif

/*-----------------------------------------------------------------------
 * Source  $Source: /cvs/shawn/shawn/apps/mi_aplic/mi_aplic_processor_factory.cpp,v $
 * Version $Revision: 197 $
 * Date    $Date: 2008-04-29 12:40:51 -0300 (mar 29 de abr de 2008) $
 *-----------------------------------------------------------------------
 * $Log: mi_aplic_processor_factory.cpp,v $
 *-----------------------------------------------------------------------*/
