function NavList({ navElements }) {
  return <ul>
      {navElements.map((element)=> {
          <li>
              {element.title}
          </li>
      })}
  </ul>;
}

export default NavList;
