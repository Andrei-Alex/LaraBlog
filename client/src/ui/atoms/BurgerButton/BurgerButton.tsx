export default function BurgerButton() {
  return (
    <div>
      <button type="button" className="relative group">
        <div className="relative flex overflow-hidden items-center justify-center rounded-full w-[40px] h-[40px] transform transition-all ring-opacity-30 duration-200">
          <div className="flex flex-col justify-between w-[10px] h-[10px] transform transition-all duration-300 origin-center overflow-hidden group-focus:-translate-y-1.5 group-focus:-rotate-90">
            <div className="bg-black h-[2px] w-7 transform transition-all duration-300 origin-left group-focus:rotate-[42deg] group-focus:w-2/3 delay-150" />
            <div className="bg-black h-[2px] w-7 rounded transform transition-all duration-300 group-focus:translate-x-10" />
            <div className="bg-black h-[2px] w-7 transform transition-all duration-300 origin-left group-focus:-rotate-[42deg] group-focus:w-2/3 delay-150" />
          </div>
        </div>
      </button>
    </div>
  );
}
