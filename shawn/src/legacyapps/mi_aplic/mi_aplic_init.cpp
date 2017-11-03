/************************************************************************
 ** This file is part of the network simulator Shawn.                  **
 ** Copyright (C) 2004-2007 by the SwarmNet (www.swarmnet.de) project  **
 ** Shawn is free software; you can redistribute it and/or modify it   **
 ** under the terms of the BSD License. Refer to the shawn-licence.txt **
 ** file in the root of the Shawn source tree for further details.     **
 ************************************************************************/
#include "legacyapps/mi_aplic/mi_aplic_init.h"
#ifdef ENABLE_MI_APLIC

#include "legacyapps/mi_aplic/mi_aplic_processor_factory.h"

extern "C" void init_mi_aplic( shawn::SimulationController& sc )
{
   mi_aplic::MiAplicProcessorFactory::register_factory( sc );
}

#endif
