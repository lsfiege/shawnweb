/************************************************************************
 ** This file is part of the network simulator Shawn.                  **
 ** Copyright (C) 2004-2007 by the SwarmNet (www.swarmnet.de) project  **
 ** Shawn is free software; you can redistribute it and/or modify it   **
 ** under the terms of the BSD License. Refer to the shawn-licence.txt **
 ** file in the root of the Shawn source tree for further details.     **
 ************************************************************************/
#ifndef __SHAWN_LEGACYAPPS_MI_APLIC_MI_APLIC_PROCESSOR_FACTORY_H
#define __SHAWN_LEGACYAPPS_MI_APLIC_MI_APLIC_PROCESSOR_FACTORY_H
#include "_legacyapps_enable_cmake.h"
#ifdef ENABLE_MI_APLIC

#include "sys/processors/processor_factory.h"

namespace shawn 
{ 
    class SimulationController; 
    class Processor;
}

namespace mi_aplic
{

   class MiAplicProcessorFactory
      : public shawn::ProcessorFactory
   {
   public:
      MiAplicProcessorFactory();
      virtual ~MiAplicProcessorFactory();

      virtual std::string name( void ) const throw();
      virtual std::string description( void ) const throw();
      virtual shawn::Processor* create( void ) throw();

      static void register_factory( shawn::SimulationController& ) throw();
   };

}

#endif
#endif
/*-----------------------------------------------------------------------
 * Source  $Source: /cvs/shawn/shawn/apps/mi_aplic/mi_aplic_processor_factory.h,v $
 * Version $Revision: 419 $
 * Date    $Date: 2010-05-26 13:29:40 -0300 (mié 26 de may de 2010) $
 *-----------------------------------------------------------------------
 * $Log: mi_aplic_processor_factory.h,v $
 *-----------------------------------------------------------------------*/
